extends CharacterBody2D

@onready var colision = $CollisionShape2D

func _ready():
	match get_tree().current_scene.name:
		"bathroom1":
			var _mostrar = Estados.vendedor_bath1
		"piso1":
			if Estados.introduccion:
				global_position = Vector2(28, -719)
			else:
				global_position = Vector2(838, -103)
				#interactuable.dialogue_start = "oferta1"
	
	#visibilidad_npc(mostrar)

func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
	else:
		hide()
		colision.disabled = true

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)
