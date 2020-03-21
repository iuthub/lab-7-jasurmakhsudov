SELECT name FROM movies WHERE year=1995

SELECT COUNT(*) FROM movies m JOIN roles r ON r.movie_id=m.id JOIN actors a ON a.id=r.actor_id WHERE m.name="Lost in Translation"

SELECT a.first_name , a.last_name FROM movies m JOIN roles r ON r.movie_id=m.id JOIN actors a ON a.id=r.actor_id WHERE m.name="Lost in Translation"

SELECT d.first_name , d.last_name FROM movies m JOIN movies_directors md ON m.id=md.movie_id JOIN directors d ON md.director_id=d.id WHERE m.name="Fight Club"

SELECT COUNT(*) FROM movies m JOIN movies_directors md ON m.id=md.movie_id JOIN directors d ON md.director_id=d.id WHERE d.first_name="Clint" AND d.last_name="Eastwood"

SELECT name FROM movies m JOIN movies_directors md ON m.id=md.movie_id JOIN directors d ON md.director_id=d.id WHERE d.first_name="Clint" AND d.last_name="Eastwood"

SELECT d.first_name , d.last_name FROM directors_genres dg JOIN directors d ON dg.director_id=d.id WHERE dg.genre="Horror"

SELECT a.first_name , a.last_name FROM directors d JOIN movies_directors md ON md.director_id=d.id JOIN movies m ON md.movie_id=m.id JOIN roles r ON m.id=r.movie_id JOIN actors a ON r.actor_id=a.id WHERE d.first_name="Christopher" AND d.last_name="Nolan"
