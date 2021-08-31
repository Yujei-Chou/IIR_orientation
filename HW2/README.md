# Recommender system practice
### LeaveOneOut
- 從training set中不同的userId都抽出一筆資料
- 把抽出的資料當作testing set
- 使用surprise.model.selection的LeaveOneOut切割資料

### Top-N Hit Rate
- 針對每個userId將training set的99筆資料與testing set的1筆資料丟進模型預測
- 預測前N個最大的rating值
- 若testing set中的那筆資料有排在前N筆則Hit
- Hit值算法=(所有userId Hit總數)/(user總數)
- functions:
```
def getUser_100Movies(UserId):
  np.random.seed(1)
  return np.append(np.random.choice(np.setdiff1d(df['movieId'].unique(), np.array(df[df['userId']==UserId]['movieId'])),99,replace=False),testSet[UserId-1][1])
  
def UserTopN_IsHit(UserId, N, model):
  User_100Movies = getUser_100Movies(UserId)
  res = pd.DataFrame()
  res['movieId'] = User_100Movies
  res['pred_rating'] = [model.predict(UserId, movieId).est for movieId in User_100Movies]
  res = res.sort_values(by='pred_rating', ascending=False)[0:N]
  if User_100Movies[-1] in res['movieId'].unique():
    return True
  else:
    return False  


def TopN_HitRate(N, model):
  Hit = 0
  for UserId in df['userId'].unique():
    if UserTopN_IsHit(UserId, N, model):
      Hit+=1
  return Hit/len(df['userId'].unique())
```
