import codecs
import os
with codecs.open('nameListForJieba') as fname:
    name =fname.readlines();
with codecs.open('jiebaResult') as fjieba:
    jieba = fjieba.readlines();

for (line, br) in zip(name, jieba):
    brCount = br.count('<br>')
    fontSize = 12 / (brCount + 1)
    print line

    newHTML = open(line[:-1], 'w')
    newHTML.write("""
    <div style=\"font-size:"""+ str(fontSize) +"""em;margin:30px 30px 0 30px;background: transparent \">"""+ br +"""<hr style=\"width:60px;font-size:10px;height:10px;background-color:white;\">
    </div>
    <img id='title_img' 
         src='lib/tpl/starter/images/"""+ line[:-1] +""".png' 
         alt='"""+ line[:-1] +"""' 
        style=\"height:10em;
                margin-left:-6em;\"
    > 
    """)
    newHTML.close()

fname.close()
fjieba.close()
