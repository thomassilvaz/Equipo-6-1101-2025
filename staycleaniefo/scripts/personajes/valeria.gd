extends CharacterBody2D

@onready var colision = $CollisionShape2D
@onready var interactuable = $Interactuable/CollisionShape2D

func play_animation(anim_name: String):
	$AnimatedSprite2D.play(anim_name)

func play_animationplayer(anim_name: String):
	$AnimationPlayer.play(anim_name)

func _ready() -> void:
	match get_tree().current_scene.name:
		"piso1":
			if Estados.charla_con_valeria:
				if !Estados.caminar_cafeteria:
					global_position = Vector2(341, 19)
				else:
					global_position = Vector2(-251, 873)
			else:
				global_position = Vector2(-186,-658)

func visibilidad_npc(visibilidad: bool):
	if visibilidad:
		show()
		colision.disabled = false
		interactuable.disabled = false
	else:
		hide()
		colision.disabled = true
		interactuable.disabled = true

func toggle_dialogo(toggle: bool):
	interactuable.disabled(toggle)
