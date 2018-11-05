# coding: utf8
import codecs
import os

import jieba


import industry_basedata
industry = industry_basedata.industry


def HTMLgen(classid, classname, photoname, photoid, bigclass):
    
    line = classname
    result = jieba.cut(classname, cut_all=False)
    br = "<br>".join(result).encode('utf-8')
    brCount = br.count('<br>')
    fontSize = 12 / (brCount + 1)

    print classid
    filename = line
    filename = filename.replace('、', '')
    filename = filename.replace('（', '')
    filename = filename.replace('）', '')
    newHTML = open(filename, 'w')

    newHTML.write(
            """<div class=\"paperclip__title\" style=\"background-image: url(lib/tpl/starter/images/bg/""" + photoid +  photoname + """.jpg);\">
        <div class='desktop__class'>
    """ + bigclass + """<hr class=\"desktop__break\"></div>"""
    """
        <div class='mobile__title' style=\"font-size:"""+ str(fontSize) +"""em; \">"""+ br +"""<hr class=\"mobile__break\">
    </div>
    <div class='desktop__title'>""" + line +"""</div>
    <div class="intro"></div>
    <div class="pet_warpper">
    <hr class="vertical_upper"/>
    <img id="pet_upper" src="lib/tpl/starter/images/pet_upper.png"/>
    </div>
    </div>
    """)
    newHTML.close()

#
#list = open('list', 'w')
#
#for classlv1 in industry:
#    bigclass = classlv1['name']
#    list.write( ' * ' + bigclass + '\n')
#    for classlv2 in classlv1['subclass']:
#        lv2name = classlv2['name']
#        lv2id = classlv2['id']
#        list.write('   * '+lv2name + '\n')
#        for classlv3 in classlv2['subclass']:
#            list.write('    * '+classlv3['name']+ '\n')
#            if len(classlv3['subclass']) == 0:
#                list.write('      * [['+classlv3['name'] + ']]\n')
#                continue
#            for classlv4 in classlv3['subclass']:
#                list.write('      * [['+classlv4['name'] + ']]\n')
#
#
#list.close()


for classlv1 in industry:
    bigclass = classlv1['name']
    for classlv2 in classlv1['subclass']:
        lv2name = classlv2['name']
        lv2id = classlv2['id']
        for classlv3 in classlv2['subclass']:
            lv3name = classlv3['name']
            lv3id = classlv3['id']
            if len(classlv3['subclass']) == 0:
                HTMLgen(lv3id, lv3name, lv2name, lv2id, bigclass)
                continue
            for classlv4 in classlv3['subclass']:
                lv4name = classlv4['name']
                lv4id = classlv4['id']
                HTMLgen(lv4id, lv4name, lv2name, lv2id, bigclass)



