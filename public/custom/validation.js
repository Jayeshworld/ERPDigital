document.addEventListener("DOMContentLoaded", function () {
    function initValidation(formSelector, rules) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        form.addEventListener("submit", function (event) {
            let isValid = validateForm(form, rules);
            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add("was-validated");
        });

        form.querySelectorAll("input, textarea, select").forEach(function (
            field
        ) {
            field.addEventListener("input", function () {
                validateField(field, rules);
            });

            field.addEventListener("change", function () {
                validateField(field, rules);
            });

            if (field.type === "file") {
                field.addEventListener("change", function () {
                    validateField(field, rules);
                });
            }
        });

        document.querySelectorAll(".is-invalid").forEach(function (field) {
            field.classList.add("was-validated");
        });
    }

    function validateField(field, rules) {
        const fieldName = field.name;
        if (!rules[fieldName]) return;

        const rulesArray = rules[fieldName].split("|");
        let errorMessage = "";

        for (const rule of rulesArray) {
            if (
                rule.startsWith("nullable") &&
                (field.value.trim() === "" || field.files?.length === 0)
            ) {
                errorMessage = "";
                break;
            } else if (
                rule.startsWith("required") &&
                (field.value.trim() === "" || field.files?.length === 0)
            ) {
                errorMessage = `${getFieldLabel(fieldName)} is required.`;
                break;
            } else if (
                rule.startsWith("numeric") &&
                field.value.trim() !== "" &&
                isNaN(field.value)
            ) {
                errorMessage = `${getFieldLabel(fieldName)} must be a number.`;
                break;
            } else if (rule.startsWith("min") && field.value.trim() !== "") {
                let minValue = parseFloat(rule.split(":")[1]);
                if (!isNaN(minValue) && parseFloat(field.value) < minValue) {
                    errorMessage = `${getFieldLabel(
                        fieldName
                    )} must be at least ${minValue}.`;
                    break;
                }
            } else if (rule.startsWith("max") && field.value.trim() !== "") {
                let maxValue = parseFloat(rule.split(":")[1]);
                if (!isNaN(maxValue) && field.value.length > maxValue) {
                    errorMessage = `${getFieldLabel(
                        fieldName
                    )} must be at most ${maxValue} characters.`;
                    break;
                }
            } else if (rule === "accepted" && !field.checked) {
                errorMessage = `${getFieldLabel(fieldName)} must be accepted.`;
                break;
            }
        }

        if (errorMessage) {
            showValidationError(field, errorMessage);
        } else {
            removeValidationError(field);
        }
    }

    function validateForm(form, rules) {
        let isValid = true;
        for (const fieldName in rules) {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (!field) continue;
            validateField(field, rules);
            if (field.classList.contains("is-invalid")) {
                isValid = false;
            }
        }
        return isValid;
    }

    function showValidationError(field, message) {
        field.classList.add("is-invalid");
        field.classList.remove("is-valid");

        let feedback = field.parentNode.querySelector(".invalid-feedback");
        if (!feedback) {
            feedback = document.createElement("div");
            feedback.classList.add("invalid-feedback");
            field.after(feedback);
        }
        feedback.textContent = message;
        feedback.classList.remove("d-none");
    }

    function removeValidationError(field) {
        if (
            field.value.trim() !== "" ||
            (field.files && field.files.length > 0)
        ) {
            field.classList.remove("is-invalid");
            field.classList.add("is-valid");
        } else {
            field.classList.remove("is-valid");
        }

        let feedback = field.parentNode.querySelector(".invalid-feedback");
        if (feedback) {
            feedback.classList.add("d-none");
        }
    }

    function getFieldLabel(fieldName) {
        const labels = {
            package_name: "Package Name",
            threshold: "Threshold",
            hsn: "HSN Code",
            description: "Description",
            category_name: "Category Name",
            category_image: "Category Image",
            terms: "Terms & Conditions",
        };
        return labels[fieldName] || fieldName.replace("_", " ").toUpperCase();
    }

    window.initValidation = initValidation;
});
