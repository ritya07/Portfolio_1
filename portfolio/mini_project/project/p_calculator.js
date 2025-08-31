function calculatePercentageAndCGPA() {
    const marks = parseFloat(document.getElementById('marks').value);
    const maxMarks = parseFloat(document.getElementById('maxMarks').value);

    if (isNaN(marks) || isNaN(maxMarks) || maxMarks === 0) {
        document.getElementById('percentageResult').innerText = "Please enter valid numbers.";
        document.getElementById('cgpaResult').innerText = "";
        return;
    }

    const percentage = (marks / maxMarks) * 100;
    const cgpa = percentage / 9.5;  // Common formula used for CGPA calculation

    document.getElementById('percentageResult').innerText = `Percentage: ${percentage.toFixed(2)}%`;
    document.getElementById('cgpaResult').innerText = `CGPA: ${cgpa.toFixed(2)}`;
}
