import MySQLdb, nltk, nltk.stem.porter as p, json

user = "i494f18_team38"

password = "my+sql=i494f18_team38"

db_con = MySQLdb.connect(host = "db.soic.indiana.edu", port = 3306, user = user, password = password, db = user)

cursor = db_con.cursor()

#nltk.download('punkt')

try:
    SQL = "SELECT * FROM cases;"
    cursor.execute(SQL)
    results = cursor.fetchall()
except Exception as e:
    print(SQL, "Error:", e)
    
else:
    pass

wordLst = []

caseLst = []

for item in results:
    innerCase = []
    for sub in item:
        wordLst.append(str(sub).lower())
        innerCase.append(str(sub).lower())
    caseLst.append(innerCase)
          
        
text = " ".join(wordLst)

tokens = nltk.word_tokenize(text)

stemmer = p.PorterStemmer()

text = [stemmer.stem(word) for word in tokens]

with open('index.json', 'w', encoding="utf8") as file1:
    json.dump(text, file1)
    
with open('cases.json', 'w', encoding="utf8") as file2:
    json.dump(caseLst, file2)
    
print("Successful")