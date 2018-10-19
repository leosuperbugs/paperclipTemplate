import jieba
import codecs
text_path = 'nameListForJieba'
with codecs.open('nameListForJieba', 'r', 'utf-8') as f:
    text=f.readlines();
title = open('jiebaResult', 'w')

for line in text:
    result = jieba.cut(line, cut_all=False)
    title.write("<br>".join(result).encode('utf-8'))

title.close()
