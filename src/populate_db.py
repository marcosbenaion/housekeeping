#! /usr/bin/python2

import sqlite3

conn = sqlite3.connect("/home/mprodrigues/.housekeeping/hk.db")
c = conn.cursor()

c.execute('''CREATE TABLE aparelhos
(nome text, kwh real, valor real, estado numeric, PRIMARY KEY(nome))''')
c.execute('''CREATE TABLE historico
(nome text, mes integer, valor real, FOREIGN KEY(nome) REFERENCES aparelhos(nome))''')

conn.commit()
c.execute('''select * from aparelhos''')
conn.close()
