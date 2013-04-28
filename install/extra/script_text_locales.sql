## Table structure

CREATE TABLE script_texts (
id INTEGER PRIMARY KEY,
deftext TEXT,
locale TEXT
);

## Text data default

INSERT INTO script_texts (deftext,locale) VALUES ('This was already installed, huh ? how this happened',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Unknown action',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Submit data',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('All done',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Installation complete',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Directory check',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('It looks like you need to chmod some directories!',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('all directories marked in red should be chmoded 0777',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Reload',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Next step',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Host',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Usually this will be localhost unless your on a cluster server.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Username',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your mysql username.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Password',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your mysql password.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Database',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your mysql database name.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Table prefix',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Prefix that you''ll give to tables [default ''U232v3'']',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Announce Url',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your announce url.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('HTTPS Announce Url',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your HTTPS announce url.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Site Email',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your site email address.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Site Name',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your site name.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Prefix',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Path',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Only required for sub-domain installs.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Cookie Domain',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your domain name - note exclude http and www.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Domain',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your site domain name - note exclude http or www.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Your domain name - note include http and www.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Write config',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Config file was saved',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Config file could not be saved',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Config file was already written',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Announce file was saved',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('announce file could not be saved',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Announce file was already written',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Go back',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Connection to database no issues reported, data may be imported.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Import database',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('The connection to the database reported the next issue: ',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('There was an error while importing the structure: ',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('check for error.',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('The structure of database was imported successful',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('There was an error while importing the basicdata: ',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Basicdata of database was imported successful',:lang);
INSERT INTO script_texts (deftext,locale) VALUES ('Finish',:lang);
## and so....

## Only will update 'locale' field with the correspond of your language,
## so will occupy just the memory needed.
## To update your language, just replaced NULL by your 'translated phrase'.

## Acronym's meaning
##  'deftext'=> 'English'    - en
##  'locale' => 'German'     - de
##  'locale' => 'French'     - fr
##  'locale' => 'Italian'    - it
##  'locale' => 'Chinese'    - zh
##  'locale' => 'Portuguese' - pt
##  'locale' => 'Spanish'    - es
##  'locale' => 'Korean'     - ko
##  'locale' => 'Russian'    - ru

UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Esto ya estaba instalado, ¿cómo puede ser eso, eh?'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='This was already installed, huh ? how this happened';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Acción desconocida'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Unknown action';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Enviar datos'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Submit data';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Todo hecho'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='All done';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Instalación completa'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Installation complete';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Verificacón de Directorios'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Directory check';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN '¡Parece que algunos directorios necesitan chmod!'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='It looks like you need to chmod some directories!';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'todos los directorios marcados en rojo deben tener un chmod 0777'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='all directories marked in red should be chmoded 0777';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Refrescar'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Reload';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Siguiente paso'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Next step';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN NULL
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Host';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Normalmente debe ser localhost a menos que servidor esté en un clúster.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Usually this will be localhost unless your on a cluster server.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Nombre de usuario'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Username';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Nombre de usuario en Mysql'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your mysql username.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Contraseña'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Password';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Tu contraseña en Mysql'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your mysql password.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Base de datos'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Database';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Nombre de la Base de datos'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your mysql database name.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Prefijo de tablas'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Table prefix';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Prefijo que tendrán las tablas [predeterminado ''U232v3'']'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Prefix that you''ll give to tables [default ''U232v3'']';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Url de Announce'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Announce Url';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'La Url del Announce.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your announce url.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Url HTTPS del Announce'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='HTTPS Announce Url';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'La Url como HTTPS del Announce.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your HTTPS announce url.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Email del Site'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Site Email';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Dirección e-mail del Site.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your site email address.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Nombre del Site'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Site Name';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El nombre del Site.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your site name.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Prefijo'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Prefix';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Sólo se necesita en instalaciones para sub-dominios.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Only required for sub-domain installs.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Ruta'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Path';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Dominio de la Cookie'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Cookie Domain';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El nombre de tu dominio - Nota excluir http y www.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your domain name - note exclude http and www.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Doninio'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Domain';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Su nombre de dominio del Site - Nota excluir http y www.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your site domain name - note exclude http or www.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El nombre de tu dominio - Nota incluir http y www.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Your domain name - note include http and www.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Escribir config'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Write config';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo config se ha guardado'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Config file was saved';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo config no se pudo guardar'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Config file could not be saved';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo config estaba ya escrito'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Config file was already written';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo announce se ha guardado'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Announce file was saved';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo announce no se pudo guardar'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='announce file could not be saved';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'El archivo announce estaba ya escrito'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Announce file was already written';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Volver'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Go back';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'La conexión a la base de datos no reportó problemas, los datos pueden ser importados.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Connection to database no issues reported, data may be imported.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Importar base de datos'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Import database';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'La conexión a la base de datos reportó el problema siguiente: '
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='The connection to the database reported the next issue: ';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Se ha producido un error al importar la estructura: '
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='There was an error while importing the structure: ';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'comprueba el error.'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='check for error.';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'La estructura de base de datos se ha importado con éxito'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='The structure of database was imported successful';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Se ha producido un error al importar el Datos: '
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='There was an error while importing the basicdata: ';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Datos de la base de datos importados correctamente'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Basicdata of database was imported successful';
UPDATE script_texts SET locale = CASE 
WHEN locale = 'de' THEN NULL
WHEN locale = 'fr' THEN NULL
WHEN locale = 'it' THEN NULL
WHEN locale = 'zh' THEN NULL
WHEN locale = 'pt' THEN NULL
WHEN locale = 'es' THEN 'Finalizar'
WHEN locale = 'ko' THEN NULL
WHEN locale = 'ru' THEN NULL
ELSE locale
END
WHERE deftext='Finish';
## and so....
