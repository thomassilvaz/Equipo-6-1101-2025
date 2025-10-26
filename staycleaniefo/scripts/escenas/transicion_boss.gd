extends Node2D

@onready var Karen = $Karen
@onready var Julian = $Julián
@onready var Mateo = $Mateo
@onready var Ronald = $Ronald
@onready var Valeria = $Valeria
@onready var Laura = $PsicólogaLaura
@onready var Muerte = $Muerte

@onready var animation_player = $AnimationPlayer 

#muestra cierta animacion del animationplayer segun el evento
func _ready() -> void:
	$animacion_murio.hide()
	if Estados.jugador_murio:
		Estados.escuela_oscura = 0
		if Estados.murio_repetido:
			animation_player.play("reintentar")
		else:
			animation_player.play("muerto")
	elif Estados.redimido:
		Estados.escuela_oscura = 0
		animation_player.play("redimido")
	else:
		animation_player.play("bienvenida_boss")
		await animation_player.animation_finished
		get_tree().change_scene_to_file("res://escenas/lugares/arena.tscn")

#funcion para mostrar una animacion de muerte distinta segun el genero
func animacion_murio():
	$animacion_murio.show()
	if Estados.nom == "Alex":
		$animacion_murio.play("hombre")
	elif Estados.nom == "Alexa":
		$animacion_murio.play("mujer")

#usado en animaciones para hacer aparecer un dialogo especifico
func trigger_dialogue(dialogue_resource: DialogueResource):
	animation_player.pause()
	
	DialogueManager.show_example_dialogue_balloon(dialogue_resource)
	await DialogueManager.dialogue_ended
	
	animation_player.play()
