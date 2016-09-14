#! /usr/bin/python2

import sqlite3

home = ("/home/pi/")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''CREATE TABLE aparelhos
(nome text, kwh real, valor real, estado integer, PRIMARY KEY(nome))''')
c.execute('''CREATE TABLE historico
(nome text, mes integer, valor real, FOREIGN KEY(nome) REFERENCES aparelhos(nome))''')

conn.commit()
conn.close()
