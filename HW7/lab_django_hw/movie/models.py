from django.db import models

# Create your models here.
class Movie(models.Model):
    user_id = models.IntegerField()
    movie_id = models.IntegerField()
    rating = models.FloatField()
