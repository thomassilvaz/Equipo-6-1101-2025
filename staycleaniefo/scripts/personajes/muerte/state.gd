extends Node2D
class_name State
 
@onready var debug = owner.find_child("debug")
@onready var player = owner.get_parent().find_child("jugador")
@onready var animation_player = owner.find_child("AnimationPlayer")

#desactiva el movimiento del boss hasta ser reactivado
func _ready():
	set_physics_process(false)

#reactiva el movimiento del boss
func enter():
	set_physics_process(true)

#lo desactiva nuevamente
func exit():
	set_physics_process(false)

#funcion plantilla que sirve para transicionar de estado
func transition():
	pass

#usado en testing, que al transicionar muestra un texto del estado activo
func _physics_process(_delta):
	transition()
	debug.text = name
