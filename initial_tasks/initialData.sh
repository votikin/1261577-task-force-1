#!/bin/bash

php yii fixture/load Role --interactive=0
php yii fixture/load Category --interactive=0
php yii fixture/load TaskStatus --interactive=0

php yii fixture/generate city --count=50 --interactive=0
php yii fixture/load City --interactive=0

php yii fixture/generate user --count=10 --interactive=0
php yii fixture/load User --interactive=0

php yii fixture/generate user_category --count=30 --interactive=0
php yii fixture/load UserCategory --interactive=0

php yii fixture/generate task --count=10 --interactive=0
php yii fixture/load Task --interactive=0

php yii fixture/generate response --count=3 --interactive=0
php yii fixture/load Response --interactive=0

php yii fixture/generate review --count=3 --interactive=0
php yii fixture/load Review --interactive=0
