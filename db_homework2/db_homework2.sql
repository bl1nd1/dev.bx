# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер и Линда Хэмилтон.
# Формат: ID фильма, Название на русском языке, Имя режиссёра.

SELECT movie.ID, t.TITLE, d.NAME FROM movie
	                                      INNER JOIN movie_title t on movie.ID = t.MOVIE_ID
	                                      INNER JOIN director d on movie.DIRECTOR_ID = d.ID
WHERE (SELECT COUNT(*) FROM movie m
	                            INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
	                            INNER JOIN movie_actor ma on m.ID = ma.MOVIE_ID
	                            INNER JOIN actor a on ma.ACTOR_ID = a.ID
       WHERE mt.LANGUAGE_ID = 'ru' AND a.ID IN (1, 3) AND m.ID = movie.ID) = 2
  AND t.LANGUAGE_ID = 'ru';

# 2. Вывести список названий фильмов на английском языке с "откатом" на русский, в случае если название на английском не задано.
# Формат: ID фильма, Название.

SELECT ru.id, IF (ISNULL(en.title), ru.title, en.TITLE) AS '1 and 2' from (SELECT * FROM movie
	                                                                                         INNER JOIN  movie_title mt on movie.ID = mt.MOVIE_ID
                                                                           WHERE LANGUAGE_ID = 'ru') ru
	                                                                          LEFT JOIN (SELECT * from movie
		                                                                                                   INNER JOIN  movie_title m on movie.ID = m.MOVIE_ID
	                                                                                     WHERE LANGUAGE_ID = 'en') en ON en.ID = ru.ID
GROUP BY ru.id;

# 3. Вывести самый длительный фильм Джеймса Кэмерона.
#  Формат: ID фильма, Название на русском языке, Длительность.

SELECT m.ID, mt.TITLE, m.LENGTH FROM movie m
	                                     INNER JOIN director d on m.DIRECTOR_ID = d.ID
	                                     INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
WHERE d.ID = 1 AND mt.LANGUAGE_ID = 'ru'
ORDER BY m.LENGTH DESC LIMIT 1;

# 4. Вывести список фильмов с названием, сокращённым до 10 символов. Если название короче 10 символов – оставляем как есть.
# Если длиннее – сокращаем до 10 символов и добавляем многоточие.
# Формат: ID фильма, сокращённое название

SELECT m.ID, IF(CHAR_LENGTH(mt.TITLE) > 10, CONCAT(TRIM(LEFT(mt.TITLE,10)), '...'), mt.TITLE) as TITLE FROM movie m
	                                                                                                            INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
ORDER BY ID;

# 5. Вывести количество фильмов, в которых снимался каждый актёр.
# Формат: Имя актёра, Количество фильмов актёра.

SELECT actor.NAME, (SELECT COUNT(a.ID) FROM actor a
	                                            INNER JOIN movie_actor ma on a.ID = ma.ACTOR_ID
                    WHERE a.ID = actor.ID) MOVIE_COUNT
FROM actor;

# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер.
# Формат: ID жанра, название

SELECT ID, NAME FROM ( SELECT * FROM genre g
	                                     LEFT JOIN (SELECT DISTINCT ACTOR_ID,GENRE_ID FROM movie_actor ma
		                                                                                       INNER JOIN movie_genre mg on mg.MOVIE_ID = ma.MOVIE_ID
	                                                WHERE ACTOR_ID = 1) t on t.GENRE_ID = g.ID) tab
WHERE ISNULL(tab.ACTOR_ID)
ORDER BY ID ASC;

# 7. Вывести список фильмов, у которых больше 3-х жанров.
# Формат: ID фильма, название на русском языке

SELECT movie.ID, mt.TITLE FROM movie
	                               INNER JOIN movie_title mt on movie.ID = mt.MOVIE_ID
WHERE (SELECT COUNT(*) FROM movie m
	                            INNER JOIN movie_genre mg on m.ID = mg.MOVIE_ID
	                            INNER JOIN genre g on mg.GENRE_ID = g.ID
       WHERE m.ID = movie.ID) > 3 AND mt.LANGUAGE_ID = 'ru'
ORDER BY ID ASC ;

# 8. Вывести самый популярный жанр для каждого актёра.
# Формат вывода: Имя актёра, Жанр, в котором у актёра больше всего фильмов.

SELECT actor.NAME,
       (SELECT g.NAME FROM genre g
	                           INNER JOIN movie_genre mg on g.ID = mg.GENRE_ID
	                           INNER JOIN movie_actor ma on mg.MOVIE_ID = ma.MOVIE_ID
	                           INNER JOIN movie m on mg.MOVIE_ID = m.ID
	                           INNER JOIN movie_title mt on m.ID = mt.MOVIE_ID
	                           INNER JOIN actor a on ma.ACTOR_ID = a.ID
        WHERE a.ID = actor.ID AND mt.LANGUAGE_ID = 'ru'
        GROUP BY g.NAME
        ORDER BY COUNT(*) DESC
        LIMIT 1) as MOST_POPULAR_GENRE
FROM actor;