import movie
import subprocess
from django.shortcuts import redirect, render

# Create your views here.
from django.http import HttpResponse
from django.http import HttpResponseRedirect
from movie.models import Movie
from django.contrib import messages
import pandas as pd


def importRating(request):
    df = pd.read_csv('ratings_small.csv')

    movies = [
        Movie(
            user_id = df.iloc[i]['userId'],
            movie_id = df.iloc[i]['movieId'],
            rating = df.iloc[i]['rating']
        )
        for i in range(1000)  
    ]
    Movie.objects.bulk_create(movies)
    return HttpResponseRedirect('home')


def listRating(request):
    ratings = Movie.objects.all()    
    return render(request, 'movie/index.html', {'ratings':ratings})

def clearRating(request):
    Movie.objects.all().delete()
    return HttpResponseRedirect('home')

def searchRating(request):
    if request.method == 'GET':
        search_user_ratings = Movie.objects.filter(user_id = request.GET['user_id'])
    return render(request, 'movie/index.html', {'ratings':search_user_ratings})


def deleteRating(request):
    if request.method == 'POST':
        Movie.objects.filter(id = request.POST['deleteId']).delete()
    return HttpResponseRedirect(request.META.get('HTTP_REFERER', '/'))


def updateRating(request):
    if request.method == 'POST':
        search_user_rating  = Movie.objects.filter(user_id = request.POST['user']).filter(movie_id = request.POST['movie'])
        if(len(search_user_rating) == 0):
            messages.error(request, "此user, movie組合不存在")
            return HttpResponseRedirect(request.META.get('HTTP_REFERER', '/'))
        else:
            search_user_rating.update(rating = request.POST['rating'])
            return HttpResponseRedirect(request.META.get('HTTP_REFERER', '/'))

def recommendMovie(request):
    # subprocess.run(['python','recommend.py',str(20)])
    recommendList = pd.read_csv('recommend.csv')
    if request.method == 'POST':
        recommendMovie = recommendList[recommendList['userId']==int(request.POST['movie_id'])]['movieId'].tolist()
        msg = "推薦電影ID:" + str(recommendMovie[0])+", " + str(recommendMovie[1])
        messages.success(request, msg)
        return HttpResponseRedirect(request.META.get('HTTP_REFERER', '/'))