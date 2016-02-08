#!/bin/bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )" #directory of the current script

cd $DIR
rm -rf tmp productive
mkdir tmp
cd tmp

echo "Retrieving code from GIT repo..."
git clone --quiet ../.. .

echo "Installing bower dependencies..."
# speed up build process by copying the dev files
mkdir bower_components
cp -r $DIR/../bower_components/jssor-slider bower_components
bower install

rm -rf .git .gitignore bower.json .bowerrc
rm -rf build/


cd $DIR
mv tmp productive
