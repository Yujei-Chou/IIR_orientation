from django.urls import path

from . import views

urlpatterns = [
    path('import', views.importRating),  
    path('home', views.listRating),   
    path('clear', views.clearRating),
    path('delete', views.deleteRating),
    path('search', views.searchRating),
    path('update', views.updateRating),
    path('recommend', views.recommendMovie),                    
]