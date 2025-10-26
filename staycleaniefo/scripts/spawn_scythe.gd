extends Node2D

@export var point_1: Vector2
@export var point_2: Vector2

@onready var scythe_node: Resource = preload("res://escenas/scythe.tscn") #nodo de la guadaña

var timer: float = 0.0 #contador usado para compararse su tiempo con el intervalo
var interval: float = 0.5 #cada cuanto aparece una nueva guadaña

#escoge un numero aleatorio entre los maximos escogidos
func get_random_point_inside(p1: Vector2, p2: Vector2) -> Vector2:
	var x_value: float = randf_range(p1.x, p2.x)
	var y_value: float = randf_range(p1.y, p2.y)

	var random_point_inside: Vector2 = Vector2(x_value, y_value)

	return(random_point_inside)

func spawn_powerup():
	var scythe_instance: Node = scythe_node.instantiate() #instancia la guadaña
	if self.name == "Spawn1":
		scythe_instance.clockwise = true #determina su direccion respecto el sentido del reloj
		scythe_instance.velocidad = 444.0 #determina su velocidad segun que nodo la instancia
	elif self.name == "Spawn2":
		scythe_instance.clockwise = false #determina su direccion respecto el sentido del reloj
		scythe_instance.velocidad = -444.0 #determina su velocidad segun que nodo la instancia
	
	add_child(scythe_instance) #añada la guadaña a la escena
	
	#declara los puntos extremos segun el nodo que tiene el script
	if self.name == "Spawn1":
		point_1 = Vector2(-384,65)
		point_2 = Vector2(-384,2250)
	elif self.name == "Spawn2":
		point_1 = Vector2(1920,65)
		point_2 = Vector2(1920,2250)
	var spawn_location: Vector2 = get_random_point_inside(point_1, point_2)
	scythe_instance.set_position(spawn_location)

#se encarga de obtener resultados aleatorios cada vez
func _ready():
	randomize()

#instancia una guadaña indefinidamente respecto a la relacion contador-intervalo
func _process(delta):
	timer += delta
	if timer >= interval:
		timer = 0.0
		spawn_powerup()
