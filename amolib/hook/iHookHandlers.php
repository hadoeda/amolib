<?php    
    interface IHookHandlers {
        function all(array $entity);
        function add(array $entity);
        function delete(array $entity);
        function restore(array $entity);
        function update(array $entity);
        function status(array $entity);
        function responsible(array $entity);
        function note(array $note);
    }
?>