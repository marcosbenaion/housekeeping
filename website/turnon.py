#! /usr/bin/python2

import sqlite3
import sys

home = ("/home/pi")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

dados = (sys.argv[1],)
c.execute('''update aparelhos set estado=1 where nome=?''', dados)

conn.commit()
conn.close()
