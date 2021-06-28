import mysql.connector
import sys

class BSTNode:
    '''
    Node BST definition
    '''
    def __init__(self, data):
        self.left = None  
        self.right = None
        self.data = data

def insertNode(root, node):             #La función requiere el ingrese de un BST y un Nodo
    '''
    Insert a node in BST
    '''
    if root == None:        #Si el BST ingresado está vacio…
        root = node		#el Nodo será el Nuevo árbol.
    else:
        if root.data > node.data:  #SI el valor del root actual es mayor que el nodo ingresado
            if root.left == None: 	#El nodo será ingresado a la izquierda
                root.left = node
            else:		  #Si la rama izquierda ya está ocupada…
                insertNode(root.left, node)  #Intentará ingresar a la izquierda de la rama donde intentó ingresar
        else:
            if root.right == None:   #Si la rama derecho está disponible…
                root.right = node		#Esta rama tomará el valor del Nodo
            else:		    #Si la rama está ocupada
                insertNode(root.right, node)   #Ingresará el valor a la derecho de la rama anterior.

def findMin(root):   #Para ejecutar está función tenemos que ingresar el árbol del cual se encontrará el mínimo
    '''
    Find the minimum value. Recursive mode
    :param root:
    :return:
    '''
    currentNode = root       #el nodo actual es el root
    if currentNode.left == None:  #Si el nodo izquierdo del árbol está vacio
        return currentNode		#Se retornará el nodo actual, que es el último elemento a la izquierda
    else:					
        return findMin(currentNode.left)      #Se realizará la búsqueda en la rama izquierda del nodo actual	

def findMax(root): #Para ejecutar está función tenemos que ingresar el árbol del cual se encontrará el máximo
    '''
    Find the maximum value. Recursive mode
    :param root:
    :return:
    '''
    currentNode = root    #El nodo del arbol tomará el valor del nodo actual
    if currentNode.right == None:  # Si el nodo derecho al nodo actual está vacio
        return currentNode		#Se retorna el nodo actual, siendo el último a la derecha del á rbol
    else:
        return findMax(currentNode.right)   #Se realizará la búsqueda en la rama izquierda del nodo actual	


def find(root, data):
    '''
    Method to find data in BST
    Rparam root:
    :return:
    '''
    currentNode = root  

    if currentNode == None:
        return None
    else:
        if data == currentNode.data:
            return currentNode
        if data < currentNode.data:
            return find(currentNode.left,data)
        else:
            return find(currentNode.right,data)

mydb=mysql.connector.connect(                
    host="remotemysql.com",
    user="jqHC38gVtv",
    password="GsaN0MHlJy",
    database="jqHC38gVtv",
)       #Se realiza la conección a la base de datos remota
 
mycursor=mydb.cursor()
#Se ingresa un sql 
mycursor.execute("SELECT cliente_id,dni FROM clientes inner JOIN pagos on clientes.id=pagos.cliente_id")
root=None
for dato in mycursor.fetchall():  
    insertNode(root, BSTNode(dato[1]))    #inserta los dni en un root       
print(find(root,int(sys.argv[1]))     #Se busca el dni de acuerdo a su valor númerico


