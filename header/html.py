# coding: utf8

import codecs
import os
with codecs.open('nameListForJieba') as fname:
    name =fname.readlines();
with codecs.open('jiebaResult') as fjieba:
    jieba = fjieba.readlines();

line = 1;
classes = [
    '农、林、牧、渔业',
    '采矿业',
    '制造业',
    '电力、热力、燃气及水生产和供应业',
    '建筑业',
    '批发和零售业',
    '交通运输、仓储和邮政业',
    '住宿和餐饮业',
    '信息传输、软件和信息技术服务业',
    '金融业',
    '房地产业',
    '租赁和商务服务业',
    '科学研究和技术服务业',
    '水利、环境和公共设施管理业',
    '居民服务、修理和其他服务业',
    '教育',
    '卫生和社会工作',
    '文化、体育和娱乐业',
    '公共管理、社会保障和社会组织',
    '国际组织',
    ''
];

divisions=[1,93,142,824,845,901,1015,1104,1127,1171,1233,1240,1308,1361,1406,1445,1467,1503,1561,1605,9999];

counter = 1;
i = 0;

for (line, br) in zip(name, jieba):
    brCount = br.count('<br>')
    fontSize = 12 / (brCount + 1)
    print line

    newHTML = open(line[:-1], 'w')
    newHTML.write("""<div class='desktop__class'>""" + classes[i] +"""<hr class=\"desktop__break\"></div>"""
    """<div class='mobile__title' style=\"font-size:"""+ str(fontSize) +"""em; \">"""+ br +"""<hr class=\"mobile__break\">
    </div>
    <div class='desktop__title'>""" + line +"""</div>
    <img id='title_img' 
         src='lib/tpl/starter/images/"""+ line[:-1] +""".png' 
         alt='"""+ line[:-1] +"""' 
        style=\"height:10em;
                margin-left:-6em;\"
    > 
    """)
    newHTML.close()
    counter += 1;
    if (counter >= divisions[i + 1]):
        i += 1;


fname.close()
fjieba.close()
