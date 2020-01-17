user = sessionStorage["username"];

mode = {
    none: '',
    create: 'create',
    update: 'update',
    saved: 'saved',
    deleted: 'deleted'
}

context = {
    none: {
        id: 'tab-none',
        name: '',
        mainPanel: true
    },
    overview: {
        id: 'overview',
        name: 'Overview',
        mainPanel: true
    },
    warmup: {
        id: 'workout-type-selection',
        name: 'Warmup',
        dbContext: 'pre_training',
        routineContext: 'pre-training',
        mainPanel: false
    },
    mainWorkout: {
        id: 'workout-type-selection',
        name: 'Main Workout',
        dbContext: 'main_training',
        routineContext: 'main-training',
        mainPanel: false
    },
    cooldown: {
        id: 'workout-type-selection',
        name: 'Cooldown',
        dbContext: 'post_training',
        routineContext: 'post-training',
        mainPanel: false
    }
}

wizard = $('#training-day-wizard');

wizard.id = {
    get: () => {
        return wizard.attr('training-day-id');
    },
    set: (newId) => {
        wizard.attr('training-day-id', newId);
    }
}
wizard.mode = {
    get: () => {
        return wizard.attr('edit-mode');
    },
    set: (newMode) => {
        wizard.attr('edit-mode', newMode);
    }
}
wizard.context = {
    get: () => {
        return wizard.activeContext;
    },
    set: (newContext) => {
        wizard.activeContext = newContext;
        wizard.attr('edit-context', newContext.id);
        $('#training-day-subtype').text(newContext.name);
        wizard.find('.active').removeClass('active');
        wizard.find(('#' + newContext.id)).addClass('active');
        if(newContext.mainPanel) {
            $('#main-control').removeClass('d-none');
            $('#sub-control').addClass('d-none');
        } else {
            $('#main-control').addClass('d-none');
            $('#sub-control').removeClass('d-none');
        }
    }
}
wizard.trainingDay = {
    get: () => {
        return wizard.attr('training-day');
    },
    set: (newTrainingDay) => {
        wizard.attr('training-day', newTrainingDay);
    }
}
wizard.trainingName = {
    get: () => {
        return $('#training-day-name').val();
    },
    set: (newTrainingName) => {
        $('#training-day-name').val(newTrainingName);
    }
}
wizard.workoutType = {
    get: () => {
        return $('.workout-type.active').attr('id');
    },
    set: (workoutType) => {
        wizard.find('.active').removeClass('active');
        $('.workout-type.active').removeClass('active');
        $('#' + workoutType).addClass('active');
    }
}
wizard.newTraining = () => {
    wizard.mode.set(mode.create);
    wizard.trainingDay.set((routines.lastDay() + 1));
    wizard.context.set(context.overview);
    $('#cancel-changes, #save-changes').removeClass('d-none');
    $('#delete').addClass('d-none');
    let trainingDay = wizard.trainingDay.get();
    api.createTraining(user, trainingDay, function(response) {
        wizard.id.set(response.id);
        let row = table.row.add([
            trainingDay,
            ''
        ]).draw().node();
        $(row).addClass('training-day training-done-0 training-skipped-0');
        $(row).attr('training-day-id', response.id);
        $(row).find('td:first-child').addClass('training-day-day');
        $(row).find('td:last-child').addClass('training-day-name');
        $(row).click(function() {
            wizard.loadTraining($(this));
            wizard.modal('show');
        });
    });
}
wizard.loadTraining = (training) => {
    wizard.mode.set(mode.update);
    wizard.id.set(training.attr('training-day-id'));
    wizard.trainingName.set(training.find('.training-day-name').text());
    wizard.trainingDay.set(training.find('.training-day-day').text());
    wizard.context.set(context.overview);
    $('#cancel-changes, #save-changes').addClass('d-none');
    $('#delete').removeClass('d-none');
    if(training.attr('pre-training-id')) {
        wizard.overview('warmup', training, 'pre');
    } else {
        wizard.addButton('warmup');
    }
    if(training.attr('main-training-id')) {
        wizard.overview('main-workout', training, 'main');
    } else {
        wizard.addButton('main-workout');
    }
    if(training.attr('post-training-id')) {
        wizard.overview('post-workout', training, 'post');
    } else {
        wizard.addButton('post-workout');
    }
}
wizard.overview = (position, training, subWorkoutPrefix) => {
    let subWorkoutId = training.attr(subWorkoutPrefix + '-training-id');
    api.getDescription(subWorkoutId, function(response) {
        $('#' + position + '-overview .description').text(response.description);
        $('#add-' + position + '-btn').addClass('d-none');
        $('#' + position + '-overview').removeClass('d-none');
    });
}
wizard.addButton = (position) => {
    $('#add-' + position + '-btn').removeClass('d-none');
    $('#' + position + '-overview').addClass('d-none');
}
wizard.clear = () => {
    wizard.context.set(context.none);
    wizard.mode.set(mode.none);
    wizard.trainingDay.set('');
    wizard.trainingName.set('');
    wizard.id.set('');
}
wizard.save = () => {
    wizard.mode.set(mode.saved);
    let id = wizard.id.get();
    let name = wizard.trainingName.get();
    let day = wizard.trainingDay.get();
    wizard.clear();
}
wizard.cancel = () => {
    if(wizard.mode.get() === mode.create) {
        wizard.delete();
    }
    wizard.clear();
}
wizard.delete = () => {
    let id = wizard.id.get();
    api.deleteTraining(id, function(response) {
        table.row($('tr[training-day-id="' + id + '"]')).remove().draw();
        wizard.mode.set(mode.deleted);
    });
}
wizard.on('hide.bs.modal', function() {
    wizard.cancel();
});
