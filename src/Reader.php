<?php

namespace OFXReader;

use OFXReader\Entity\Transaction;
use OFXReader\Exception\FileNotFoundException;
use OFXReader\Exception\IncorrectFileExtensionException;

class Reader
{
    private string $filePath;
    
    private function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        $this->processFile();
    }

    public static function read(string $filePath): OFX
    {
        $reader = new Reader($filePath);

        return $reader->processFile();
    }

    private function startsWithOpeningTag($string)
    {
        return preg_match('/^<(?!\/)/', $string) === 1;
    }

    private function getTagContent($string)
    {
        if (preg_match('/^<[^>]*>/', $string, $matches)) {
            return $matches[0];
        }
        return null;
    }

    private function getInnerContent($string)
    {
        if (preg_match('/<[^>]+>(.*?)(?=<\/[^>]+>|$)/s', $string, $matches)) {
            return $matches[1];
        }
        return null; // Return null if no match is found
    }

    private function startTransaction(&$ofx, &$readingTransaction, &$currentTransaction)
    {
        if ($readingTransaction) $ofx->addTransaction($currentTransaction);
        $currentTransaction = new Transaction();
        $readingTransaction = true;
    }

    private function processFile(): OFX
    {
        $ext = pathinfo($this->filePath, PATHINFO_EXTENSION);

        if (strtolower($ext) != 'ofx') throw new IncorrectFileExtensionException('The file needs to be an OFX.');

        $file = fopen(
            $this->filePath,
            'r'
        );

        if (!$file) throw new FileNotFoundException("The file at \"{$this->filePath}\" was not found.");

        /** @var Transaction|null $currentTransaction */
        $currentTransaction = null;
        $readingTransaction = false;

        $ofx = new OFX();

        while (($line = fgets($file)) !== false) {
            $line = ltrim($line);
            $line = rtrim($line);

            if ($this->startsWithOpeningTag($line)) {
                $tag = new Tag($this->getTagContent($line));
                $innerContent = $this->getInnerContent($line);

                match ($tag->text) {
                    '<STMTTRN>'  => $this->startTransaction($ofx, $readingTransaction, $currentTransaction),
                    '<FITID>'    => $currentTransaction->setId($innerContent),
                    '<TRNTYPE>'  => $currentTransaction->setTipo($innerContent),
                    '<DTPOSTED>' => $currentTransaction->setDate($innerContent),
                    '<TRNAMT>'   => $currentTransaction->setValue($innerContent),
                    '<MEMO>'     => $currentTransaction->setExtraInformation($innerContent),
                    default      => null
                };
            }
        }

        if ($readingTransaction) $transactions[] = $currentTransaction;

        var_dump($ofx->transactions());

        return $ofx;
    }
}
