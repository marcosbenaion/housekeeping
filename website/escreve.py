file = open('texto.txt','w+')
file.write("hello wolrd in the new file")
file.write("and another line")
print file.read()
file.close()