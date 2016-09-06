#! /usr/bin/python2

import os
import sqlite3
import sys

home = os.getenv("HOME")
conn = sqlite3.connect(home + "/.housekeeping/hk.db")
c = conn.cursor()

dados = (sys.argv[1], sys.argv[2], sys.argv[3])
c.execute('''INSERT INTO aparelhos VALUES(?, ?, ?, 0)''', dados) #na insercao o estado original sempre sera off, isto e, 0.

conn.commit()
conn.close()
