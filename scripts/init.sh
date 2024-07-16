#!/bin/bash

url_root="https://github.com/openEHR/"
declare -a components=(
                      "specifications"
                      "specifications-AA_GLOBAL"
                      "specifications-BASE"
                      "specifications-LANG"
                      "specifications-AM"
                      "specifications-QUERY"
                      "specifications-TERM"
                      "specifications-RM"
                      "specifications-PROC"
                      "specifications-CDS"
                      "specifications-SM"
                      "specifications-ITS"
                      "specifications-ITS-REST"
                      "specifications-ITS-XML"
                      "specifications-ITS-JSON"
                      "specifications-ITS-BMM"
                      "specifications-CNF"
                      "specifications-UML"
                      )
cd /data/repos

for component_dir in "${components[@]}"
  do
    if [ ! -d $component_dir ]; then
        git clone $url_root$component_dir
        echo "cloned $component_dir"
    else
        echo "component $component_dir exists"
        cd $component_dir
        git clean -d -f
        git fetch --tags
        git pull
        cd ..
    fi
  done
