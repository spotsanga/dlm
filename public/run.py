import json
import pymysql
pymysql.install_as_MySQLdb()
import MySQLdb
from newsapi import NewsApiClient

newsapi = NewsApiClient(api_key='4b4233b0e7c243ea8bdd9abf5a19bbbd')
sources = 'the-hindu,bbc-news,fox-news,the-times-of-india,cnn,espn'

def getArticles():
        db = MySQLdb.connect('127.0.0.1','root','','dlm')
        cursor = db.cursor()
        page,limit = 1,10
        while page <= limit:
                result = newsapi.get_everything(sources=sources,language='en',page=page)
                articles = result['articles']
                for article in articles:
                        if not article['title'] or not article['description']:
                                continue
                        values=[article['source']['name'],article['author'],json.dumps(article['title']),json.dumps(article['description'])]
                        values.extend([article['url'],article['urlToImage'],article['publishedAt']])
                        query = 'insert into articles(name,author,title,description,url,urlToImage,publishedAt) values("%s","%s",%s,%s,"%s","%s","%s")'\
                        %tuple(values)
                        try:
                                cursor.execute(query)
                        except:
                                pass
                db.commit()
                print('completed=>'+str(page))
                page+=1
        db.close()
        #sleep(3600)
        #getArticles()
try:
        getArticles()
except:
        pass
