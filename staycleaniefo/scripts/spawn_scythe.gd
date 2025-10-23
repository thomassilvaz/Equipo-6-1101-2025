extends Node2D

@export var point_1: Vector2
@export var point_2: Vector2

@onready var scythe_node: Resource = preload("res://escenas/scythe.tscn")

var timer: float = 0.0
var interval: float = 0.5

func get_random_point_inside(p1: Vector2, p2: Vector2) -> Vector2:
	var x_value: float = randf_range(p1.x, p2.x)
	var y_value: float = randf_range(p1.y, p2.y)

	var random_point_inside: Vector2 = Vector2(x_value, y_value)

	return(random_point_inside)

func spawn_powerup():
	var scythe_instance: Node = scythe_node.instantiate()
	if self.name == "Spawn1":
		scythe_instance.clockwise = true
		scythe_instance.velocidad = 444.0
	elif self.name == "Spawn2":
		scythe_instance.clockwise = false
		scythe_instance.velocidad = -444.0
	
	add_child(scythe_instance)

	if self.name == "Spawn1":
		point_1 = Vector2(-384,65)
		point_2 = Vector2(-384,2250)
	elif self.name == "Spawn2":
		point_1 = Vector2(1920,65)
		point_2 = Vector2(1920,2250)
	var spawn_location: Vector2 = get_random_point_inside(point_1, point_2)
	scythe_instance.set_position(spawn_location)

func _ready():
	randomize()

func _process(delta):
	timer += delta
	if timer >= interval:
		timer = 0.0
		spawn_powerup()
