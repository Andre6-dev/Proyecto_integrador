import mysql.connector #Esta libreria se debe instalar con: pip install mysql-connector-python
import sys

class Heap:
    '''
    Heap class
    '''
    def __init__(self):
        self.heapList = []
        self.size = 0

    def parentIndex(self, index):
        return (index-1) //2

    def leftChildIndex(self, index):
        return 2 * index + 1

    def leftChild(self, index):
        '''
        Get value of left child
        :param index:
        :return:
        '''
        leftIndex = self.leftChildIndex(index)
        if leftIndex < self.size:
            return self.heapList[leftIndex]
        return -1

    def rightChildIndex(self, index):
        return 2 * index + 2

    def rightChild(self, index):
        '''
        Get value of right child
        :param index:
        :return:
        '''
        rightIndex = self.rightChildIndex(index)
        if rightIndex < self.size:
            return self.heapList[rightIndex]
        return -1

    def searchElement(self, itm):
        i = 0
        while (i <= self.size):
            if itm == self.heapList[i]:
                return i
            i += 1

    def maximumChildIndex(self, idx):

        valueLeftChild = self.leftChild(idx)
        valueRightChild = self.rightChild(idx)

        if valueLeftChild > valueRightChild :
            return self.leftChildIndex(idx)
        elif  valueLeftChild < valueRightChild :
            return self.rightChildIndex(idx)
        else :
            # return any child index
            return self.leftChildIndex(idx)

    def minimumChildIndex(self, idx):
        valueLeftChild = self.leftChild(idx)
        valueRightChild = self.rightChild(idx)
        #print("valueLeftChild = %d" % valueLeftChild)
        #print("valueRightChild = %d" % valueRightChild)

        if valueRightChild == -1 :
            return self.leftChildIndex(idx)

        if valueLeftChild > valueRightChild :
            return self.rightChildIndex(idx)
        elif  valueLeftChild < valueRightChild :
            return self.leftChildIndex(idx)
        else :
            # return any child index
            return self.rightChildIndex(idx)

    def getTop(self):
        '''
        Get root value for Heap
        :return:
        '''
        if self.size == 0:
            return -1
        return self.heapList[0]

    def insert(self, k):
        '''
        Insert an element at the end
        of heap and apply percolate up
        :param k:
        :return:
        '''
        self.heapList.append(k)           #Se ingresa el valor en el HeapList
        self.size = self.size + 1            #Aumenta el size 
        self.percolateup(self.size - 1)   #Se realiza la función de percolateup en el size anterior del Heap
    def percolateup(self,i):           
        while (i!=0):
            p=self.parentIndex(i)
            if self.heapList[p] < self.heapList[i]:    #Se insertan los elementos en orden, de ser necesario sus posiciones son cambiadas
                self.heapList[p], self.heapList[i]=self.heapList[i] < self.heapList[p]
            i=p

    def buildHeap(self,list): #Se construye el Heap en base a una lista ingresada
        i = len(list) // 2
        self.size = len(list)
        self.heapList = list
        while i >= 0:
            self.percolateup(i)
            i = i - 1

class Vertex:
    
    def __init__(self,key):    #Al instanciar la clase se necesita ingresar un valor como key
        self.id = key                #La variable de clase id toma el valor key
        self.adjList = {}           #Se declara una adjlist

    def addNeighbor(self,nbr,weight=0):   #Para agregar un Neighbor se ingresa su nbr y la longitude de este (por defecto es 0)
        self.adjList[nbr] = weight                 #El element ode adjList tomará el valor de weight 

    def getAdjLists(self):                      #La función getAdjList retorna las llaves del adjList
        return self.adjList.keys()

    def getId(self):                                     #Función getId retorna la variable de clase self.id
        return self.id

    def getWeight(self,nbr):                  #Esta función retorna el weight  del element de AdjList indicado como parametro
        return self.adjList[nbr]

mydb=mysql.connector.connect(                
    host="remotemysql.com",
    user="jqHC38gVtv",
    password="GsaN0MHlJy",
    database="jqHC38gVtv",
)       #Se realiza la conección a la base de datos remota
 
mycursor=mydb.cursor()
#Se ingresa un sql 
mycursor.execute("SELECT clientes.nombres,count((pagos.cliente_id)) FROM clientes inner JOIN pagos on clientes.id=pagos.cliente_id GROUP BY nombres")


list=[]
#Se crea un vertex para almacenar 
nvertex=Vertex(1)
for dato in mycursor.fetchall(): 
        list.append(dato[1])  #Los elementos númericos se almacenan en la lista
        nvertex.addNeighbor(dato[0],dato[1])  #Se almacenan los nombres y los valores númericos en el vertex

heap = Heap()
#Se instnacia un heap y le enviamos la lista de números
heap.buildHeap(list)

#Por cada nombre en el vertex
for llave in nvertex.adjList:
    #Se extraera el valor de este
    cant=nvertex.adjList[llave]
    # Si el valor actual es igual al heap de posición... 
    # sys,argv -> indica el parametro enviado junto con la ejecución del .py
    # Será tomado como un valor númerico y usado como una posición.
    if cant==heap.heapList[int(sys.argv[1])]:  #Si el contenido extraido tiene el mismo valor que el elemento en la posición indicada por el heap...
        #Se imprime el nombre del cliente y su valor respectivo.    
        print("Articulo: ",llave,"Precio: ", heap.heapList[int(sys.argv[1])])
        

#El algoritmo podría mejorarse para que el vertex o biblioteca empleada, 
#organize sus datos como un percolateup y agilice la ejecución de este script