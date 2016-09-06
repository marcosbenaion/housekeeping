#! /usr/bin/python2

import os
import sqlite3

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

dados = (sys.argv[2], sys.argv[3], sys.argv[1])
c.execute('''update aparelhos set nome=? kwh=? where nome=?''')

conn.commit()
conn.close()
