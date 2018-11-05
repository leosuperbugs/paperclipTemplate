# coding: utf8
import codecs
import os

import jieba


import industry_basedata
industry = industry_basedata.industry

def process(name):
    name = name.replace('/', '')
    name = name.replace('、', '')
    name = name.replace('）', '')
    name = name.replace('（', '')
    return name


list = open('listForHome', 'w')

for classlv1 in industry:
    bigclass = classlv1['name']
    lv1id = classlv1['id']
    lv1name = process(bigclass)
    list.write("""
        <div class="firstlv higherlv" id=\""""+lv1name+"""\">
        <div class="firstlv_left">
        <img class="firstlv_icon" src="lib/tpl/starter/images/trinity.svg">"""
        + lv1id +
        """.
        </div>
        <div class="firstlv_right">
        """
        + bigclass
        +
        """
        </div>
        </div>
        """
        )
    list.write("""<div class='firstlv_warpper noshow'>""")
    for classlv2 in classlv1['subclass']:
        lv2name = classlv2['name']
        lv2nameForLink = process(lv2name)
        lv2id = classlv2['id']
        list.write("""
            <div class="secondlv lowerlv" id=\""""+lv2nameForLink+"""\">
            """
            + lv2name
            +
            """</div>
            """
            )
        list.write("""<div class='secondlv_warpper noshow'>""")
        
        for classlv3 in classlv2['subclass']:
            lv3id = classlv3['id']
            lv3name = classlv3['name']
            lv3nameForLink = process(lv3name)
            list.write("""
                <div class="thirdlv lowerlv" id=\""""+lv3nameForLink+"""\">"""+ lv3name +"""</div>
                """)
            list.write("""<div class="lowestgrp noshow">""")
            
            base = lv1name + ':' + lv2nameForLink + ':' + lv3nameForLink + ':'
            if len(classlv3['subclass']) == 0:
                list.write("""
                    <a class="fourthlv lowerlv" id=\""""+lv3nameForLink+"""\" target='_blank' href="/doku.php?id="""
               + base +lv3nameForLink+
                """ ">"""
                    +lv3id+ """1."""
                +lv3name+"""</a>
                    """)
                list.write('</div>')
            else:
                for classlv4 in classlv3['subclass']:
                    lv4name = classlv4['name']
                    lv4nameForLink = process(lv4name)
                    lv4id = classlv4['id']
                    list.write("""
                        <a class="fourthlv lowerlv" id=\""""+lv4nameForLink+"""\" target='_blank'  href="/doku.php?id="""
                               +base+lv4nameForLink+
                               """ ">"""
                        +lv4id+ """."""
                               +lv4name+"""</a>
                        """)
                list.write('</div>')
        list.write('</div>')
    list.write('</div>')

list.close()
