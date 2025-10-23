extends State

@export var minion_node : PackedScene
var can_transition: bool = false
 
func enter():
	super.enter()
	animation_player.play("summon")
	await animation_player.animation_finished
	can_transition = true
 
func spawn():
	var spawn_count = randi() % 3 + 1
	for i in range(spawn_count):
		var minion = minion_node.instantiate()
		minion.position = owner.position + Vector2(150, -150)
		get_tree().current_scene.add_child(minion)
		
		if i < spawn_count - 1:
			await get_tree().create_timer(1.0).timeout
 
 
func transition():
	if can_transition:
		get_parent().change_state("Follow")
		can_transition = false
