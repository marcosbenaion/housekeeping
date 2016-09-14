#! /usr/bin/python2

import sqlite3
import sys

home = ("/home/pi")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

dados = (sys.argv[1], sys.argv[2])
c.execute('''INSERT INTO aparelhos VALUES(?, ?, 0, 0)''', dados) #na insercao o estado original sempre sera off e o valor 0.

conn.commit()
conn.close()
