<?php

namespace App\Services;

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;
use Phpml\Dataset\ArrayDataset;
use Phpml\Metric\Accuracy;
use Phpml\Tokenization\WordTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Classification\NaiveBayes;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;

class SentimentAnalysisService
{
    protected $classifier;

    public function __construct()
    {
        // Train your sentiment analysis classifier
        $samples = [
            ['I love this product', 'positive'],
            ['This product is terrible', 'negative'],
            // Add more training data
        ];

        // Tokenize text and calculate TF-IDF
        $tokenizer = new WordTokenizer();
        $dataset = new ArrayDataset(
            array_map(function ($sample) use ($tokenizer) {
                return $tokenizer->tokenize($sample[0]);
            }, $samples),
            array_column($samples, 1)
        );

        $tfIdfTransformer = new TfIdfTransformer();
        $tfIdfTransformer->fit($dataset->getSamples(), $dataset->getTargets());
        $dataset = $tfIdfTransformer->transform($dataset);

        // Train classifier
        $this->classifier = new SVC(Kernel::LINEAR);
        $this->classifier->train($dataset->getSamples(), $dataset->getTargets());
    }

    public function analyzeSentiment($text)
    {
        // Tokenize input text and calculate TF-IDF
        $tokenizer = new WordTokenizer();
        $tfIdfTransformer = new TfIdfTransformer($tokenizer);

        $textVector = $tfIdfTransformer->transform(new ArrayDataset([$tokenizer->tokenize($text)]));

        // Predict sentiment
        return $this->classifier->predict(current($textVector->getSamples()));
    }
}
