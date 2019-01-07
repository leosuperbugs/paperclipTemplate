# coding: utf8
import codecs
import os
import industry_basedata

industry = industry_basedata.industry

count = 0
for classlv1 in industry:
    for classlv2 in classlv1['subclass']:
        for classlv3 in classlv2['subclass']:
            if len(classlv3['subclass']) == 0:
                count += 1
                continue
            for classlv4 in classlv3['subclass']:
                count += 1

print count



