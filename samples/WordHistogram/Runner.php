<?php

namespace WordHistogram;

require __DIR__ . '/../../vendor/autoload.php';

$classLoader = new \Symfony\Component\ClassLoader\UniversalClassLoader();
$classLoader->registerNamespace('HadoopLib', '../../lib');
$classLoader->registerNamespace('WordHistogram', '../');
$classLoader->register();

//define('HADOOP_LIB_DEBUG', true);

$hadoop = new \HadoopLib\Hadoop('/usr/local/Cellar/hadoop');

$job = $hadoop->createJob('WordHistogram', 'Temp')
    ->setMapper(new Mapper())
    ->setReducer(new Reducer())
    ->clearData()
    ->addTask('Hello World')
    ->addTask('Hello Hadoop')
    //->addTask('Tasks/MapReduceTutorial.txt')
    ->putResultsTo('Temp/Results.txt')
    ->run();

echo $job->getLastResults();