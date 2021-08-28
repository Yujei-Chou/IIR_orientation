import pandas as pd
import sys
import numpy as np
import joblib

ratings = pd.read_csv('ratings_small.csv')
df = ratings.drop(['timestamp'], axis=1)
SVD_model = joblib.load("AI_model/SVD_model.pkl")

# def getUser_100Movies(UserId):
#   np.random.seed(1)
#   return np.random.choice(np.setdiff1d(df['movieId'].unique(), np.array(df[df['userId']==UserId]['movieId'])),100,replace=False)

# def UserTopN(UserId, N, model):
#   User_100Movies = getUser_100Movies(UserId)
#   res = pd.DataFrame()
#   res['movieId'] = User_100Movies
#   res['pred_rating'] = [model.predict(UserId, movieId).est for movieId in User_100Movies]
#   res = res.sort_values(by='pred_rating', ascending=False)[0:N] 
#   return res

# UserTopN(sys.argv[1], 2, SVD_model).to_csv('recommend.csv',index=False)


