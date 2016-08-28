CREATE TABLE aparelhos (
       nome text,
       kwh real,
       valor real,
       estado numeric,
       PRIMARY KEY(nome)
)

CREATE TABLE historico (
       nome text,
       mes integer,
       valor real,
       FOREIGN KEY(nome)
)
