<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 1.5rem 2rem;
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .content {
            padding: 2rem;
        }
        h2 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background-color: #f59e0b;
            color: white;
        }
        .btn-primary:hover {
            background-color: #d97706;
        }
        .btn-secondary {
            background-color: #6b7280;
            color: white;
            text-decoration: none;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
        }
        .appointment-info {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .info-item {
            margin-bottom: 0.5rem;
        }
        .info-label {
            font-weight: 600;
            color: #374151;
            display: block;
        }
        .info-value {
            color: #6b7280;
        }
        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-edit"></i> Edit Appointment</h1>
        </div>
        
        <div class="content">
            <!-- Success Message (would be shown after successful update) -->
            <div id="successMessage" class="alert alert-success" style="display: none;">
                <i class="fas fa-check-circle"></i> Appointment updated successfully!
            </div>

            <!-- Appointment Information -->
            <div class="appointment-info">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">
                    <i class="fas fa-info-circle"></i> Appointment Details
                </h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Appointment ID:</span>
                        <span class="info-value" id="appointmentId">#12345</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Doctor:</span>
                        <span class="info-value" id="doctorName">Dr. Smith</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Patient:</span>
                        <span class="info-value" id="patientName">John Doe</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Current Status:</span>
                        <span class="info-value" id="currentStatus">Pending</span>
                    </div>
                </div>
            </div>

            <h2><i class="fas fa-edit"></i> Edit Appointment Details</h2>
            
            <form id="editAppointmentForm" class="space-y-3">
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" value="2023-11-15" required>
                </div>
                
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" value="10:00" required>
                </div>
                
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="pending">Pending</option>
                        <option value="accepted" selected>Accepted</option>
                        <option value="declined">Declined</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="notes">Notes:</label>
                    <textarea id="notes" name="notes" placeholder="Add any notes about this appointment...">Patient requested a follow-up consultation for test results.</textarea>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="#" class="btn btn-secondary" onclick="goBack()">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sample appointment data (in a real app, this would come from the server)
        const appointment = {
            id: 12345,
            doctor_name: "Dr. Smith",
            patient_name: "John Doe",
            date: "2023-11-15",
            time: "10:00",
            status: "accepted",
            notes: "Patient requested a follow-up consultation for test results."
        };

        // Populate form with appointment data
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('appointmentId').textContent = `#${appointment.id}`;
            document.getElementById('doctorName').textContent = appointment.doctor_name;
            document.getElementById('patientName').textContent = appointment.patient_name;
            document.getElementById('currentStatus').textContent = appointment.status.charAt(0).toUpperCase() + appointment.status.slice(1);
            
            document.getElementById('date').value = appointment.date;
            document.getElementById('time').value = appointment.time;
            document.getElementById('status').value = appointment.status;
            document.getElementById('notes').value = appointment.notes;
        });

        // Form submission
        document.getElementById('editAppointmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            const status = document.getElementById('status').value;
            const notes = document.getElementById('notes').value;
            
            // In a real application, you would send this data to the server
            console.log('Updating appointment:', { date, time, status, notes });
            
            // Show success message
            document.getElementById('successMessage').style.display = 'flex';
            
            // Update the current status display
            document.getElementById('currentStatus').textContent = status.charAt(0).toUpperCase() + status.slice(1);
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                document.getElementById('successMessage').style.display = 'none';
            }, 5000);
        });

        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);

        // Go back function
        function goBack() {
            alert('In a real application, this would navigate back to the appointments list.');
            // window.history.back(); // Uncomment for real navigation
        }
    </script>
</body>
</html>