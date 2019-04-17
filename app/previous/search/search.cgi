#! /usr/bin/env python3

import cgi, cgitb

import json, nltk, nltk.stem.porter as p

form = cgi.FieldStorage()

cgitb.enable()

terms = []

try:
	terms = form.getfirst("terms", "female+hit+and+run")
	terms = terms.split("+")
except Exception as e:
	print(e)
else:
	pass

try:
    with open('index.json', 'r', encoding="utf8") as file1:
        contents = json.load(file1)

    with open('cases.json', 'r', encoding="utf8") as file2:
        caseContents = json.load(file2)
except:
    contents = ""
    caseContents = ""

#nltk.download('punkt')

def search(terms, index, cases):

    text = [piece.strip().lower() for piece in terms]

    text = " ".join(text)

    tokens = nltk.word_tokenize(text)

    stemmer = p.PorterStemmer()

    stemList = [stemmer.stem(word) for word in tokens]

    queryTerms = stemList

    matchedInfo = []

    for term in queryTerms:
        for item in index:
            if term == item:
                if term not in matchedInfo:
                    matchedInfo.append(term)

    results = []

    for matchTerm in matchedInfo:
        for case in cases:
            for item in case:
                if matchTerm in item:
                    if case not in results:
                        results.append(case[0])

    return results



results = search(terms, contents, caseContents)

formVars = ",".join(results)

url = "../index.php?ids=" + formVars


print('Location: ' + url)
print()
