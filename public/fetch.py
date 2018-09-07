import json
import pymysql
pymysql.install_as_MySQLdb()
import MySQLdb
from newsapi import NewsApiClient
newsapi = NewsApiClient(api_key='4b4233b0e7c243ea8bdd9abf5a19bbbd')
db = MySQLdb.connect('127.0.0.1', 'root', '', 'dlm')
cursor = db.cursor()
sources = 'the-hindu,bbc-news,fox-news,the-times-of-india,cnn,espn'


def fetch(cid, category, page):
    result = newsapi.get_everything(
        q=category, sources=sources, language='en', page=page)
    articles = result['articles']
    for article in articles:
        if not article['title'] or not article['description']:
            continue
        print(article, category)
        values = [article['source']['name'], article['author'], json.dumps(
            article['title']), json.dumps(article['description'])]
        values.extend(
            [article['url'], article['urlToImage'], article['publishedAt']])
        query = 'insert into articles(source,author,title,description,url,urlToImage,publishedAt) values("%s","%s",%s,%s,"%s","%s","%s")'\
            % tuple(values)
        try:
            cursor.execute(query)
        except:
            pass
        query = "select id from articles where title=%s and publishedAt='%s'" % (
            values[2], values[-1])
        cursor.execute(query)
        result = cursor.fetchall()
        query = "insert into article_to_category_mapping(article_id,category_id) values(%d,%d)" % (
            result[0][0], cid)
        cursor.execute(query)


query = "select id,category from categories"
cursor.execute(query)
categories = cursor.fetchall()
for category in categories:
    for page in range(1, 11):
        fetch(category[0], category[1], page)
db.commit()
