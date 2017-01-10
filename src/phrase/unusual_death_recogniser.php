<?php

declare(strict_types=1);

namespace betterphp\recogniser\phrase;

use betterphp\recogniser\string_recogniser;

class unusual_death_recogniser implements string_recogniser {

    /**
     * Helper function to scrape a list of deaths from WikiPedia
     *
     * @return array The death list
     */
    private function get_death_list(): array {
        $data = file_get_contents("https://en.wikipedia.org/wiki/List_of_unusual_deaths");

        preg_match_all('#<li>(.+)</li>#Uis', $data, $matches);

        $death_list = array_filter($matches[1], function (string $list_item): bool {
            return substr($list_item, 0, 5) !== '<cite'
                && strpos($list_item, '<b>') !== false
                && !preg_match('#^<(a|b|strong|i|cite).+</\1>$#is', $list_item);
        });

        $death_list = array_map(function (string $death_string): array {
            $year = trim(substr($death_string, 0, strpos($death_string, ':')));

            preg_match('#<b>(.+)</b>#Ui', $death_string, $matches);
            $name = strip_tags(trim(($matches[1] ?? '')));

            $description = substr($death_string, (strlen($year) + 1));
            $description = strip_tags(trim($description));
            $description = str_replace($name, '', $description);
            $description = trim($description);

            return [
                'year' => $year,
                'name' => $name,
                'description' => $description,
            ];
        }, $death_list);

        return $death_list;
    }

    /**
     * @inheritDoc
     */
    public function recognises(string $input): ?bool {
        $deaths = $this->get_death_list();

        $input = strtolower($input);

        $input_words = explode(' ', $input);
        $input_words = array_filter($input_words);

        // Skip short words in input string
        $input_words = array_filter($input_words, function (string $word): bool {
            return strlen($word) > 3;
        });

        $total_input_words = count($input_words);

        foreach ($deaths as $death) {
            $description = preg_replace('#[^a-z\- ]+#i', '', $death['description']);
            $description = trim($description);
            $description = strtolower($description);

            $description_words = explode(' ', $description);

            $total_description_words = count($description_words);

            // Name is also recognised if they died unusually
            if (strtolower($death['name']) === $input) {
                return true;
            }

            // If the query is longer than the description then it cannot be a match
            if ($total_input_words > $total_description_words || strlen($input) > strlen($description)) {
                continue;
            }

            $last_match_position = 0;
            $total_matched_words = 0;

            // Similar words to all input words must exist in the same order
            foreach ($input_words as $input_word) {
                // Only check from the last match onwards
                for ($i = $last_match_position; $i < $total_description_words; ++$i) {
                    $description_word = $description_words[$i];

                    similar_text($input_word, $description_word, $confidence);

                    if ($confidence > 80) {
                        $last_match_position = $i;
                        ++$total_matched_words;

                        // Go to next input word
                        continue 2;
                    }
                }
            }

            // If all of the words were matched then it's recognised
            if ($total_matched_words === $total_input_words) {
                return true;
            }
        }

        return false;
    }

}
