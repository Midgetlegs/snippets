def read():
    file = open("adventuredrops.txt", "r")
    readFile = file.read()
    print (readFile)
    file.close()
    main()
    
def write():
    file = open("adventuredrops.txt", "a")
    search = ""
    search += (input("Explorer: ")) + "\t"
    search +=(input("Length of search: ")) + "\t"
    search += (input("Adventure found: ")) + "\n"
    file.write(search)
    print ("You added: ", search)
    file.close()
    main()

def main():
    response = input("Read or write to file? ").lower()
    if response == "read" or response == "r":
        read()
    elif response == "write" or response == "w":
        write()
    else:
        main()

main()
