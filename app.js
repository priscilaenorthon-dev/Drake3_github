// Drake3 Application JavaScript

// Task management state
let tasks = [];
let taskIdCounter = 0;

// Initialize app on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Drake3 Application Loaded');
    loadTasks();
    setupEventListeners();
});

// Setup event listeners
function setupEventListeners() {
    // Allow Enter key to add tasks
    const taskInput = document.getElementById('taskInput');
    if (taskInput) {
        taskInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                addTask();
            }
        });
    }
    
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Show dashboard section
function showDashboard() {
    const dashboardSection = document.getElementById('dashboard');
    if (dashboardSection) {
        dashboardSection.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Task Management Functions
function addTask() {
    const taskInput = document.getElementById('taskInput');
    const taskText = taskInput.value.trim();
    
    if (taskText === '') {
        alert('Por favor, insira uma tarefa.');
        return;
    }
    
    const task = {
        id: taskIdCounter++,
        text: taskText,
        completed: false,
        createdAt: new Date().toISOString()
    };
    
    tasks.push(task);
    saveTasks();
    renderTasks();
    taskInput.value = '';
    taskInput.focus();
}

function toggleTask(taskId) {
    const task = tasks.find(t => t.id === taskId);
    if (task) {
        task.completed = !task.completed;
        saveTasks();
        renderTasks();
    }
}

function deleteTask(taskId) {
    tasks = tasks.filter(t => t.id !== taskId);
    saveTasks();
    renderTasks();
}

function renderTasks() {
    const taskList = document.getElementById('taskList');
    if (!taskList) return;
    
    if (tasks.length === 0) {
        taskList.innerHTML = '<li style="text-align: center; color: #6b7280; padding: 2rem;">Nenhuma tarefa adicionada ainda.</li>';
        return;
    }
    
    taskList.innerHTML = tasks.map(task => `
        <li class="task-item ${task.completed ? 'completed' : ''}">
            <span class="task-text">${escapeHtml(task.text)}</span>
            <div class="task-actions">
                <button class="btn-complete" onclick="toggleTask(${task.id})">
                    ${task.completed ? 'Reativar' : 'Concluir'}
                </button>
                <button class="btn-delete" onclick="deleteTask(${task.id})">Excluir</button>
            </div>
        </li>
    `).join('');
}

function saveTasks() {
    try {
        localStorage.setItem('drake3_tasks', JSON.stringify(tasks));
    } catch (e) {
        console.error('Error saving tasks:', e);
    }
}

function loadTasks() {
    try {
        const stored = localStorage.getItem('drake3_tasks');
        if (stored) {
            tasks = JSON.parse(stored);
            taskIdCounter = tasks.length > 0 ? Math.max(...tasks.map(t => t.id)) + 1 : 0;
            renderTasks();
        }
    } catch (e) {
        console.error('Error loading tasks:', e);
    }
}

// Contact form handling
function handleSubmit(event) {
    event.preventDefault();
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
    
    // Simulate form submission
    console.log('Form submitted:', { name, email, message });
    
    const formMessage = document.getElementById('formMessage');
    formMessage.className = 'form-message success';
    formMessage.textContent = 'Mensagem enviada com sucesso! Entraremos em contato em breve.';
    
    // Reset form
    event.target.reset();
    
    // Hide message after 5 seconds
    setTimeout(() => {
        formMessage.style.display = 'none';
    }, 5000);
}

// Utility function to escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Export functions for testing
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        addTask,
        toggleTask,
        deleteTask,
        escapeHtml
    };
}
