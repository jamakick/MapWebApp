import json, nltk, nltk.stem.porter as p


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
                        results.append(case)
                        
    for result in results:
        print(result)
        
        

search(["female", "hit and run"], contents, caseContents)