<?php

namespace Sentgine\Helper;

/**
 * Class Word
 *
 * A helper class for string manipulation operations.
 */
class Word
{
    public string $string;

    private function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * Creates a new instance of Word with the given string.
     *
     * @param string $string The input string.
     * @return Word The Word instance.
     */
    public static function of(string $string): Word
    {
        return new self($string);
    }

    /**
     * Applies the specified operation to the string and returns the result.
     *
     * @param callable $operation The operation to apply.
     * @return Word The current Word instance.
     * @throws \InvalidArgumentException If the operation does not return a string.
     */
    public function apply(callable $operation): Word
    {
        $result = $operation($this);

        if (!is_string($result)) {
            throw new \InvalidArgumentException("The operation must return a string.");
        }

        $this->string = $result;
        return $this;
    }


    /**
     * Converts the string to PascalCase.
     *
     * @return string The string converted to PascalCase.
     */
    public function pascalCase(): string
    {
        // Remove non-alphanumeric characters and split by spaces or underscores
        $words = preg_split('/[\s_]+/', $this->string);

        // Capitalize the first letter of each word
        $words = array_map('ucfirst', $words);

        // Join the words back together
        return implode('', $words);
    }

    /**
     * Converts the string to kebab-case.
     *
     * @return string The string converted to kebab-case.
     */
    public function kebabCase(): string
    {
        return strtolower(preg_replace('/\s+/', '-', trim(preg_replace('/[^a-z0-9]+/', ' ', $this->string))));
    }

    /**
     * Converts the string to snake_case.
     *
     * @return string The string converted to snake_case.
     */
    public function snakeCase(): string
    {
        return strtolower(preg_replace('/\s+/', '_', trim(preg_replace('/[^a-z0-9]+/', ' ', $this->string))));
    }

    /**
     * Converts the string to camelCase.
     *
     * @return string The string converted to camelCase.
     */
    public function camelCase(): string
    {
        $words = preg_split('/[\s_]+/', $this->string);
        $firstWord = array_shift($words);
        $words = array_map('ucfirst', $words);
        array_unshift($words, $firstWord);
        return lcfirst(implode('', $words));
    }

    /**
     * Converts the string to Title Case (Proper Case).
     *
     * @return string The string converted to Title Case.
     */
    public function titleCase(): string
    {
        return ucwords(strtolower($this->string));
    }

    /**
     * Retrieves a substring of the string based on the given start and length.
     *
     * @param int $start The start position of the substring.
     * @param int|null $length The length of the substring. If null, extracts until the end of the string.
     * @return string The extracted substring.
     */
    public function substring(int $start, ?int $length = null): string
    {
        return substr($this->string, $start, $length);
    }

    /**
     * Retrieves the length of the string.
     *
     * @return int The length of the string.
     */
    public function length(): int
    {
        return strlen($this->string);
    }

    /**
     * Concatenates the given strings with the current string.
     *
     * @param string ...$strings The strings to concatenate.
     * @return Word The current Word instance.
     */
    public function concatenate(string ...$strings): Word
    {
        $this->string .= implode('', $strings);
        return $this;
    }

    /**
     * Performs a regular expression match on the string.
     *
     * @param string $pattern The regular expression pattern.
     * @return array|null An array of matches or null if no matches found.
     */
    public function match(string $pattern): ?array
    {
        preg_match($pattern, $this->string, $matches);
        return $matches ?: null;
    }

    /**
     * Performs a regular expression replacement on the string.
     *
     * @param string $pattern The regular expression pattern.
     * @param string $replacement The replacement string.
     * @return Word The current Word instance.
     */
    public function replaceRegex(string $pattern, string $replacement): Word
    {
        $this->string = preg_replace($pattern, $replacement, $this->string);
        return $this;
    }

    /**
     * Converts the string to lowercase.
     *
     * @return string The lowercase string.
     */
    public function toLower(): string
    {
        return strtolower($this->string);
    }

    /**
     * Converts the string to uppercase.
     *
     * @return string The uppercase string.
     */
    public function toUpper(): string
    {
        return strtoupper($this->string);
    }

    /**
     * Trims whitespace from both ends of the string.
     *
     * @return Word The current Word instance.
     */
    public function trim(): Word
    {
        $this->string = trim($this->string);
        return $this;
    }

    /**
     * Replaces all occurrences of a substring with another string.
     *
     * @param string $search The substring to search for.
     * @param string $replace The string to replace occurrences with.
     * @return Word The current Word instance.
     */
    public function replace(string $search, string $replace): Word
    {
        $this->string = str_replace($search, $replace, $this->string);
        return $this;
    }

    /**
     * Prepends the given strings before the current string.
     *
     * @param string ...$strings The strings to prepend.
     * @return Word The current Word instance.
     */
    public function prepend(string ...$strings): Word
    {
        $this->string = implode('', $strings) . $this->string;
        return $this;
    }

    /**
     * Appends the given strings after the current string.
     *
     * @param string ...$strings The strings to append.
     * @return Word The current Word instance.
     */
    public function append(string ...$strings): Word
    {
        $this->string .= implode('', $strings);
        return $this;
    }

    /**
     * Checks if the string contains the specified word.
     *
     * @param string|array $word The word or array of words to search for.
     * @return bool Returns true if the word is found, otherwise returns false.
     */
    public function contains(string|array $word): bool
    {
        if (is_array($word)) {
            foreach ($word as $w) {
                if (stripos($this->string, $w) !== false) {
                    return true;
                }
            }
            return false;
        } else {
            return stripos($this->string, $word) !== false;
        }
    }

    /**
     * Capitalizes the appended word and replaces all occurrences of that word in the string.
     *
     * @param string $word The word to be appended and capitalized
     *
     * @return Word The modified Word object
     */
    public function capitalizeAppendedWord(string $word): Word
    {
        // Convert the entire string to lowercase
        $lowerString = $this->toLower();

        // Split the string into parts using the lowercase version of the word as delimiter
        $parts = explode(strtolower($word), $lowerString);

        // If the explode result doesn't have at least two parts, return without further modification
        if (count($parts) < 2) {
            return $this;
        }

        // Capitalize the word
        $capitalizedWord = ucfirst($word);

        // Reconstruct the string with the capitalized word
        $this->string = $parts[0] . $capitalizedWord . $parts[1];

        // Replace all occurrences of the lowercase word with the capitalized word
        $this->string = str_replace(strtolower($word), $capitalizedWord, $this->string);

        // Return the modified Word object
        return $this;
    }

    /**
     * Removes the specified series of letters from the string.
     *
     * @param string|array $letters The series of letters to remove.
     * @return Word The current Word instance.
     */
    public function removeLetters(string|array $letters): Word
    {
        if (is_array($letters)) {
            $this->string = str_replace($letters, '', $this->string);
        } else {
            $this->string = str_replace($letters, '', $this->string);
        }
        return $this;
    }

    /**
     * Singularizes the English word.
     *
     * @return Word The current Word instance.
     */
    public function singular(): Word
    {
        $word = $this->string;

        // Define some basic singularization rules
        $singularRules = [
            '/(s|sh|ch|x|z)es$/i' => '\1',     // Words ending with s, sh, ch, x, z followed by es
            '/(fe?)s$/i' => '\1',               // Words ending with f or fe followed by s
            '/([^aeiou])ies$/i' => '\1y',       // Words ending with consonant followed by ies
            '/([^aeiou])ys$/i' => '\1y',        // Words ending with consonant followed by ys
            '/s$/i' => '',                      // Words ending with s
        ];

        foreach ($singularRules as $pattern => $replacement) {
            if (preg_match($pattern, $word)) {
                $this->string = preg_replace($pattern, $replacement, $word);
                return $this;
            }
        }

        // If no specific rule matches, return the word as is
        return $this;
    }

    /**
     * Pluralizes the English word.
     *
     * @return Word The current Word instance.
     */
    public function plural(): Word
    {
        $word = $this->string;

        // Define some basic pluralization rules
        $pluralRules = [
            '/(s|sh|ch|x|z)$/i' => '\1es',   // Words ending with s, sh, ch, x, z
            '/(fe?)$/i' => '\1s',             // Words ending with f or fe
            '/(a|e|i|o|u)y$/i' => '\1ys',     // Words ending with a vowel followed by y
            '/y$/i' => 'ies',                 // Words ending with y
        ];

        foreach ($pluralRules as $pattern => $replacement) {
            if (preg_match($pattern, $word)) {
                $this->string = preg_replace($pattern, $replacement, $word);
                return $this;
            }
        }

        // If no specific rule matches, just add 's' to the end
        $this->string .= 's';
        return $this;
    }

    /**
     * Retrieves the final processed string.
     *
     * @return string The processed string.
     */
    public function get(): string
    {
        return $this->string;
    }
}
