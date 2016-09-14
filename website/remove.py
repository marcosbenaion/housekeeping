#! /usr/bin/python2

import sqlite3
import sys

home = ("/home/pi")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

dados = (sys.argv[1],)
c.execute('''DELETE FROM aparelhos where nome=?''', dados)

conn.commit()
conn.close()
