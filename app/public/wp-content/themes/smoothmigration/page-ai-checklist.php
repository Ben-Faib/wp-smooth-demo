<?php
/**
 * Template Name: AI Relocation Checklist
 * 
 * @package smoothmigration
 */

get_header();
?>

<style>
.checklist-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 100px 0 60px;
    color: white;
    position: relative;
    overflow: hidden;
}

.checklist-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='0.1'%3E%3Cpolygon fill='white' points='50 0 60 40 100 50 60 60 50 100 40 60 0 50 40 40'/%3E%3C/g%3E%3C/svg%3E");
    background-size: 100px 100px;
}

.checklist-content {
    background: #f8f9fa;
    padding: 60px 0;
}

.checklist-form {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 40px;
}

.form-section {
    margin-bottom: 30px;
}

.form-section h3 {
    color: #2c3e50;
    font-size: 1.5rem;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
}

.feature-card {
    background: white;
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-bottom: 15px;
}

.how-it-works {
    background: white;
    padding: 60px 0;
}

.step-card {
    text-align: center;
    padding: 30px;
}

.step-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: bold;
    margin: 0 auto 20px;
}

.preview-section {
    background: white;
    border-radius: 12px;
    padding: 40px;
    margin-top: 40px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.checklist-preview {
    border-left: 4px solid #667eea;
    padding-left: 20px;
    margin: 20px 0;
}

.checklist-preview h4 {
    color: #2c3e50;
    margin-bottom: 15px;
}

.checklist-preview ul {
    list-style: none;
    padding: 0;
}

.checklist-preview li {
    padding: 8px 0;
    color: #6c757d;
}

.checklist-preview li:before {
    content: "✓";
    color: #667eea;
    font-weight: bold;
    margin-right: 10px;
}

.ai-badge {
    display: inline-block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    margin-left: 10px;
}

.form-control:focus, .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.btn-generate {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 12px 40px;
    border: none;
    border-radius: 6px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-generate:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    color: white;
}
</style>

<div class="checklist-hero">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-3">AI-Powered Relocation Checklist</h1>
        <p class="lead">Get a personalized, comprehensive checklist tailored to your specific relocation needs.</p>
        <span class="ai-badge">Powered by AI</span>
    </div>
</div>

<div class="checklist-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checklist-form">
                    <h2 class="mb-4">Generate Your Custom Checklist</h2>
                    <p class="text-muted mb-4">Answer a few questions and our AI will create a personalized relocation checklist just for you.</p>
                    
                    <form id="checklistForm">
                        <div class="form-section">
                            <h3>Basic Information</h3>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="origin" class="form-label">Current Location</label>
                                    <input type="text" class="form-control" id="origin" placeholder="e.g., New York, USA" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" class="form-control" id="destination" placeholder="e.g., London, UK" required>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="moveDate" class="form-label">Planned Move Date</label>
                                    <input type="date" class="form-control" id="moveDate" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="familySize" class="form-label">Family Size</label>
                                    <select class="form-select" id="familySize" required>
                                        <option value="">Select...</option>
                                        <option value="single">Single</option>
                                        <option value="couple">Couple</option>
                                        <option value="family-small">Family (2-3 members)</option>
                                        <option value="family-large">Family (4+ members)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Relocation Details</h3>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="purpose" class="form-label">Purpose of Move</label>
                                    <select class="form-select" id="purpose" required>
                                        <option value="">Select...</option>
                                        <option value="work">Work/Career</option>
                                        <option value="study">Education</option>
                                        <option value="retirement">Retirement</option>
                                        <option value="family">Family Reasons</option>
                                        <option value="lifestyle">Lifestyle Change</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="housing" class="form-label">Housing Status</label>
                                    <select class="form-select" id="housing">
                                        <option value="">Select...</option>
                                        <option value="arranged">Already Arranged</option>
                                        <option value="searching">Currently Searching</option>
                                        <option value="need-help">Need Assistance</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Services Needed (Check all that apply)</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="visa" value="visa">
                                    <label class="form-check-label" for="visa">Visa & Immigration</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="moving" value="moving">
                                    <label class="form-check-label" for="moving">Moving & Storage</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="realEstate" value="realEstate">
                                    <label class="form-check-label" for="realEstate">Real Estate</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="banking" value="banking">
                                    <label class="form-check-label" for="banking">Banking & Finance</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="insurance" value="insurance">
                                    <label class="form-check-label" for="insurance">Insurance</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="education" value="education">
                                    <label class="form-check-label" for="education">Schools & Education</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-section">
                            <h3>Contact Information</h3>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn-generate">
                                <i class="fas fa-magic me-2"></i>
                                Generate My Checklist
                            </button>
                        </div>
                    </form>
                </div>
                
                <div class="preview-section">
                    <h3 class="mb-4">Sample Checklist Preview</h3>
                    <p class="text-muted">Here's an example of what your personalized checklist will include:</p>
                    
                    <div class="checklist-preview">
                        <h4>6 Months Before Move</h4>
                        <ul>
                            <li>Research visa requirements and begin application process</li>
                            <li>Start decluttering and deciding what to move</li>
                            <li>Begin researching neighborhoods in destination city</li>
                            <li>Get quotes from international moving companies</li>
                        </ul>
                    </div>
                    
                    <div class="checklist-preview">
                        <h4>3 Months Before Move</h4>
                        <ul>
                            <li>Finalize housing arrangements</li>
                            <li>Schedule medical check-ups and gather health records</li>
                            <li>Start learning about local customs and language</li>
                            <li>Research schools if moving with children</li>
                        </ul>
                    </div>
                    
                    <div class="checklist-preview">
                        <h4>1 Month Before Move</h4>
                        <ul>
                            <li>Confirm moving date with shipping company</li>
                            <li>Cancel or transfer utilities and subscriptions</li>
                            <li>Update address with banks and government agencies</li>
                            <li>Pack essential items for immediate needs</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h4>AI-Powered Personalization</h4>
                    <p class="text-muted">Our AI analyzes your specific situation to create a checklist tailored exactly to your needs.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>Timeline-Based Tasks</h4>
                    <p class="text-muted">Tasks are organized by timeline, ensuring you complete everything at the right time.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h4>Downloadable PDF</h4>
                    <p class="text-muted">Get your checklist as a beautifully formatted PDF you can print or save for reference.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sync"></i>
                    </div>
                    <h4>Regular Updates</h4>
                    <p class="text-muted">Receive email reminders and updates as your move date approaches.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="how-it-works">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">How It Works</h2>
            <p class="lead text-muted">Get your personalized checklist in 3 simple steps</p>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Tell Us About Your Move</h4>
                    <p class="text-muted">Fill out the form with your relocation details and specific needs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>AI Generates Your Checklist</h4>
                    <p class="text-muted">Our AI analyzes your information and creates a comprehensive, personalized checklist.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Download & Track Progress</h4>
                    <p class="text-muted">Get your checklist instantly and track your progress with our mobile-friendly format.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('checklistForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Show loading state
    const btn = this.querySelector('.btn-generate');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generating...';
    btn.disabled = true;
    
    // Simulate processing (in production, this would submit to backend)
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        alert('Thank you! Your personalized checklist is being generated. You will receive it via email shortly. This feature is coming soon!');
    }, 2000);
});
</script>

<?php get_footer(); ?>
