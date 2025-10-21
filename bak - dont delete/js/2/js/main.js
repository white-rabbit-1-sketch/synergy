$(document).ready(function() {
    const NOTES_STORAGE_KEY = 'notes';

    function initNotes() {
        $('#note-list').html('');
        $.each(getNoteList(), function(index, text) {
            showNote(index, text);
        });
    }

    function showNote(id, text) {
        let lines = text.split('\n');
        let title = lines[0];
        let description = lines.slice(1).join('\n');

        let note = $('#note-placeholder').clone();
        note.attr('data-id', id);
        note.find('note-title').html(title);
        note.find('note-description').html(description);

        $('#note-list').append(note);
        note.removeClass('hidden');
    }

    function getNoteList() {
        let notesData = localStorage.getItem(NOTES_STORAGE_KEY)

        return notesData ? JSON.parse(notesData) : [];
    }

    function getNoteTextById(id) {
        return getNoteList()[id];
    }

    function saveNoteList(noteList) {
        localStorage.setItem(NOTES_STORAGE_KEY, JSON.stringify(noteList))
    }

    function addNote(text) {
        let noteList = getNoteList();
        noteList.push(text);
        saveNoteList(noteList);

        return noteList.length;
    }

    function removeNote(id) {
        let noteList = getNoteList();
        noteList.splice(id, 1);
        saveNoteList(noteList);
    }

    function updateNote(id, text) {
        let noteList = getNoteList();
        noteList[id] = text;
        saveNoteList(noteList);
    }

    $('#note-form').submit(function() {
        let modal = $('#noteModal');
        let id = modal.attr('data-id');
        let textArea = $('#save-note-textarea');
        let text = textArea.val();

        if (!id) {
            addNote(text);
        } else {
            updateNote(id, text);
        }

        initNotes();
        modal.modal('hide');
    });

    $(document).on('click', '.note-remove-button', function() {
        let note = $(this).closest('.note');
        let id = note.attr('data-id');
        removeNote(id);

        initNotes();
    });

    $(document).on('click', '.note-edit-button', function() {
        let note = $(this).closest('.note');
        let id = note.attr('data-id');
        let modal = $('#noteModal');
        let textArea = $('#save-note-textarea');

        let noteData = getNoteTextById(id);

        textArea.val(noteData);
        modal.modal('show');
        modal.attr('data-id', id);
    });

    $('.new-note-button').click(function() {
        let modal = $('#noteModal');
        let textArea = $('#save-note-textarea');
        textArea.val('');
        modal.attr('data-id', '');
    });

    initNotes();
});

