<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
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
            background: linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%);
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
        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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
            width: 100%;
            justify-content: center;
        }
        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2563eb;
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
        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-calendar-check"></i> Book Appointment</h1>
        </div>
        
        <div class="content">
            <!-- Success Message -->
            <div id="successMessage" class="alert alert-success" style="display: none;">
                <i class="fas fa-check-circle"></i> Appointment booked successfully!
            </div>
            
            <form id="appointmentForm" class="space-y-3">
                <div class="form-group">
                    <label for="doctor_id">Doctor:</label>
                    <select id="doctor_id" name="doctor_id" required>
                        <option value="">Select a doctor</option>
                        <option value="1">Dr. Smith (Cardiology)</option>
                        <option value="2">Dr. Johnson (Dermatology)</option>
                        <option value="3">Dr. Williams (Pediatrics)</option>
                        <option value="4">Dr. Brown (Orthopedics)</option>
                    </select>
                    <div id="doctorError" class="error"></div>
                </div>
                
                <div class="form-group">
                    <label for="patient_name">Your Name:</label>
                    <input type="text" id="patient_name" name="patient_name" required>
                    <div id="nameError" class="error"></div>
                </div>
                
                <div class="form-group">
                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>
                    <div id="dateError" class="error"></div>
                </div>
                
                <div class="form-group">
                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required>
                    <div id="timeError" class="error"></div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-book-medical"></i> Book Appointment
                </button>
            </form>
        </div>
    </div>

    <script>
        // Form submission
        document.getElementById('appointmentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.textContent = '');
            
            // Get form values
            const doctorId = document.getElementById('doctor_id').value;
            const patientName = document.getElementById('patient_name').value;
            const date = document.getElementById('date').value;
            const time = document.getElementById('time').value;
            
            let isValid = true;
            
            // Validate Doctor
            if (!doctorId) {
                document.getElementById('doctorError').textContent = 'Please select a doctor';
                isValid = false;
            }
            
            // Validate Patient Name
            if (!patientName.trim()) {
                document.getElementById('nameError').textContent = 'Please enter your name';
                isValid = false;
            }
            
            // Validate Date
            if (!date) {
                document.getElementById('dateError').textContent = 'Please select a date';
                isValid = false;
            } else {
                const selectedDate = new Date(date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (selectedDate < today) {
                    document.getElementById('dateError').textContent = 'Please select a future date';
                    isValid = false;
                }
            }
            
            // Validate Time
            if (!time) {
                document.getElementById('timeError').textContent = 'Please select a time';
                isValid = false;
            }
            
            if (isValid) {
                // Show success message
                document.getElementById('successMessage').style.display = 'flex';
                
                // Reset form
                document.getElementById('appointmentForm').reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    document.getElementById('successMessage').style.display = 'none';
                }, 5000);
            }
        });
        
        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').setAttribute('min', today);
    </script>
</body>
</html>