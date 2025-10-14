extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

func _ready():
	match get_tree().current_scene.name:
		"bathroom2":
			if !Estados.baño:
				interactuable.set_deferred("disabled", true)
		"piso1":
			if Estados.introduccion:
				global_position = Vector2(28, -719)
			else:
				global_position = Vector2(838, -103)
		"piso2":
			if Estados.decision3_tomada:
				global_position = Vector2(2324, 75)
			else:
				global_position = Vector2(28, -2000)

func activar_dialogo():
	interactuable.set_deferred("disabled", false)

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)
