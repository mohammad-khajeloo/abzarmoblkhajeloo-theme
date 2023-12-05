#!/usr/bin/env bash

if [[ -z "${ECOMMERCE_BASE_PATH}" ]]; then
    echo "please add ECOMMERCE_BASE_PATH environment variable";
    exit 1;
fi;

php ${ECOMMERCE_BASE_PATH}/artisan hctemplate:clear &&
  cp -rf public/views/* ${ECOMMERCE_BASE_PATH}/resources/hc-template/originals/ &&
  cp -rf public/HCMS-assets ${ECOMMERCE_BASE_PATH}/public_html/ &&
  php ${ECOMMERCE_BASE_PATH}/artisan hctemplate:init